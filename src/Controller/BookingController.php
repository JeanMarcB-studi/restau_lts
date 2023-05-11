<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Repository\OpenHourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_booking')]
    public function index(OpenHourRepository $OpenHourRepository,BookingRepository $BookingRepository): Response
    {        
        return $this->render('page/booking.html.twig', 
        [
            'maxDate' => $this->maxDate(),
            'remainSeats' => $this->remainSeats($BookingRepository, $OpenHourRepository),
            'weekDetail' => $OpenHourRepository->findAll(),            
        ]);
    }
    
    #[Route('/booking/handle', name: 'app_booking_handle')]
    public function handleForm(Request $request): Response
    {
        // dd($request->request);

        dd($request->request);
        $myDate = $request->request->get('book-date');
        dd($myDate);

        // $booking = new Booking();
        // $booking->setBookingDate();

        // $bookingRepository->save($booking, true);

        // return $this->redirectToRoute('app_booking_controller_in_index', [], Response::HTTP_SEE_OTHER);
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
    private function remainSeats(BookingRepository $BookingRepository, OpenHourRepository $OpenHourRepository){
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
