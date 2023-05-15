<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Repository\OpenHourRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_booking')]
    public function index(OpenHourRepository $OpenHourRepository, BookingRepository $BookingRepository): Response
    {        
        return $this->render('page/booking.html.twig', 
        [
            'maxDate' => $this->maxDate(),
            'bookCalendar' => $this->bookCalendar($BookingRepository, $OpenHourRepository),
            'weekDetail' => $OpenHourRepository->findAll(),            
        ]);
    }
    
    #[Route('/booking/handle', name: 'app_booking_handle' , methods: ['GET', 'POST'])]
    public function handleForm(Request $request, BookingRepository $BookingRepository): Response
    {
        
        // dd($request->request);
        $req = $request->request;
        
        try {
        $bookDate = new \DateTime($req->get('book-date'));
        $hour = new \DateTime($req->get('book-date')." ".$req->get('hour'));
        $seats =  (int)$req->get('seats');
        $firstName = ucwords(strtolower(trim($req->get('firstName'))));
        $lastName = strtoupper(trim($req->get('lastName')));
        $email = trim($req->get('email'));
        $phoneNumber = trim($req->get('phoneNumber'));
        $message = trim($req->get('message'));
        $today = new \DateTime();
        
        $booking = new Booking();
        $booking->setBookingTime($hour);
        $booking->setBookingDate($bookDate);
        $booking->setNumberPeople($seats);
        $booking->setFirstName($firstName);
        $booking->setLastName($lastName);
        $booking->setComment($message);
        $booking->setCreationDate($today);
        $booking->setEmail($email);
        $booking->setPhone($phoneNumber);
        
         // dd($booking);

        $BookingRepository->save($booking, true);
            // return $this->redirectToRoute('app_booking_controller_in_index', [], Response::HTTP_SEE_OTHER);

            return $this->render('page/bookingOK.html.twig', [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'bookDate' => $bookDate->format("d/m/Y"),
                'bookHour' => $hour->format("H:i"),
                'seats' => $seats,
            ]);
        }       
        catch (Exception $e) {
            // dd($e->getMessage());
            return $this->render('page/bookingOK.html.twig', []);
        // return $this->render('page/bookingOK.html.twig', ['toto' => 'titi'     ]);
            // return $this->redirectToRoute('app_booking', [], Response::HTTP_SEE_OTHER);
            // return $this->render('page/booking.html.twig');
        }
    }
    
    
    
    private function maxDate() 
    {
        $today = new \DateTime();
        $max = $today->add(new \DateInterval('P21D'));
        return $max;
    }

// PREPARE CALENDAR FOR 3 WEEKS WITH RESERVATIONS DONE INCLUDED
    private function tableReserv(BookingRepository $BookingRepository)
    {
        $date = new \DateTime();
        
        // $BookingRepository = new BookingRepository();
        $reserv = array();
        $elt = array();
        
        for ($i = 0; $i < 21; $i++ ){
            $elt['date'] = $date->format("Y-m-d");
            $elt['dayNum'] = (int) $date->format("N");
            $elt['seats'] = 0;
            $elt['reserved'] = 0;
            $elt['available'] = 0;
            
            $elt['mealTime'] = 'MIDI';
            $reserv[] = $elt;
            
            $elt['mealTime'] = 'SOIR';
            $reserv[] = $elt;
            
            $date->modify('+1 day');
        }
        
        // SUBSTRACT BOOKINGS ALREADY DONE
        $bookingsDone = $BookingRepository->queryAllFuture();
        
        foreach ($bookingsDone as $booking){
            foreach ($reserv as $key => $el){
                if ($el['date'] === $booking['booking_date']
                and $el['mealTime'] === $booking['lunch_or_dinner']) {

                    $reserv[$key]['reserved'] += (int) $booking['total_people'];
                }
                // dump($booking['total_people']);
            }
        }
        return $reserv;
    }

    
// CALCULATE NB OF FREE SEATS BY DAY BY MEAL ON 1 WEEK
    private function getWeekRoom(OpenHourRepository $OpenHourRepository)
    {
        $fullWeek = $OpenHourRepository->findAll();
        $room = array();
        $dayNum = 0;

        foreach($fullWeek as $day){
            $dayNum++;
            $room[$dayNum]['MIDI'] = $day->getLunchMax();
            $room[$dayNum]['SOIR'] = $day->getDinnerMax();
        }
        return $room;
    }

// COMBINE TO CALCULATE FREE SEATS BY DAY AND BY MEAL ON 3 WEEKS 
    private function bookCalendar(BookingRepository $BookingRepository, OpenHourRepository $OpenHourRepository){
        $weekRoom = $this->getWeekRoom($OpenHourRepository);
        $reserv = $this->tableReserv($BookingRepository);
        
        foreach($reserv as $key =>$elt){
            // $reserv[$key]['reserved'] += (int) $weekRoom[$elt['dayNum']][$elt['mealTime']];
            $reserv[$key]['seats'] += (int) $weekRoom[$elt['dayNum']][$elt['mealTime']];
            $reserv[$key]['available'] = $reserv[$key]['seats'] - $reserv[$key]['reserved'];
        }
        return $reserv;
    }

}
