<?php
namespace bookingsystem\Controller;
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);
class DashboardController {
    protected $template;
    protected $request;

    public function __construct($request)
    {
        $this->request =  $request;
        $this->template = clone $request->getTemplate();
    }
    
    public function dashboard()
    {
        $this->template->loadTemplateFile('dashboard.html'); 
	    $busObj = new \BookingSystem\Model\Entity\Bus();
       
		$result = $busObj->allIdBookings();		
       	//print_r($busObj->getAllMyBookings());die();	
        foreach ($result as $bus) {
			$busObj->setBusOrderId($bus);
			if($busObj->getMyBooking()) {
				$busId = $busObj->getBusBookingId();
				$busObj->setId($busId);
				$busObj->get();
				
				//$route = $bus->getRoute()->getRouteName()
				//die( $busObj->getBusBookingId());
				$this->template->setVariable([
				            'ORDER_ID'         => $bus,
							'BUS_ROUTE'        => $busObj->getRoute()->getRouteName(),
							'PASSENGER_ID'     => $busObj->getTicketBookingUserId(),
							'BUS_BOOKING_DATE' => $busObj->getTicketBookingDate(),
							'JOURNEY_DATE'     => $busObj->getJourneyDate(),
							'TOTAL_AMOUNT'     => $busObj->getTotalAmount(),
							'PASSENGER_COUNT'  => $busObj->getPassengerCount(),
							'SEATS_NUMBERS'    => $busObj->getSeatNumbers()
				]); 
				$this->template->parse('show_booking');
			}	
		}			
		return $this->template->get();
    }

     
}    