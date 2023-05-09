<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\OpenHourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            // 'tableReserv' => $this->tableReserv($BookingRepository),
            'remainSeats' => $this->remainSeats($BookingRepository, $OpenHourRepository),
            'weekDetail' => $OpenHourRepository->findAll(),
            // 'wr' => $this->getWeekRoom($OpenHourRepository),
            
        ]);
    }
    
    private function maxDate() 
    {
        $today = new \DateTime();
        $max = $today->add(new \DateInterval('P21D'));
        return $max;
    }


// CALCULATE NB OF FREE SEATS BY DAY BY MEAL ON 1 WEEK
    public function getWeekRoom(OpenHourRepository $OpenHourRepository)
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

// PREPARE CALENDAR FOR 3 WEEKS WITH RESERVATIONS DONE INCLUDED
    public function tableReserv(BookingRepository $BookingRepository)
    {
        $date = new \DateTime();
        
        // $BookingRepository = new BookingRepository();
        $reserv = array();
        $elt = array();
        
        for ($i = 0; $i < 21; $i++ ){
            $elt['date'] = $date->format("Y-m-d");
            $elt['dayNum'] = (int) $date->format("N");
            $elt['reserved'] = 0;
            
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

                    $reserv[$key]['reserved'] -= (int) $booking['total_people'];
                }
                // dump($booking['total_people']);
            }
        }
        return $reserv;
    }

// COMBINE TO CALCULATE FREE SEATS BY DAY AND BY MEAL ON 3 WEEKS 
    public function remainSeats(BookingRepository $BookingRepository, OpenHourRepository $OpenHourRepository){
        $weekRoom = $this->getWeekRoom($OpenHourRepository);
        $reserv = $this->tableReserv($BookingRepository);
        
        foreach($reserv as $key =>$elt){
            $reserv[$key]['reserved'] += (int) $weekRoom[$elt['dayNum']][$elt['mealTime']];
        }
        return $reserv;
    }

}
