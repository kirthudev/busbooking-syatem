<?php
namespace bookingsystem\Controller;
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);
class MyBookingController {
    protected $template;
    protected $request;

    public function __construct($request)
    {
        $this->request =  $request;
        $this->template = clone $request->getTemplate();
    }
	
	public function bookingDetails()
    {
        $this->template->loadTemplateFile('bookingdetails.html'); 
        $postValues = $this->request->getPostParams();
		$busObj = new \BookingSystem\Model\Entity\Bus();
        $successMsg = '';
        if (isset($_GET['msg']) && $_GET['msg'] == 'conformbooking') {
            $successMsg = " Booking done sucessfully";
        }
		$this->template->setVariable([
			
			'SUCESS'        => !empty($successMsg) ? $successMsg : '' 
		]);
        $this->template->parse('data');
		//die($_SESSION["id"]);
		$busObj->setTicketBookingUserId($_SESSION["id"]);
		$result = $busObj->getAllMyBookings();		
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
        if(isset($postValues['vseat'])) {
		$this->template->hideBlock('data');
		   $deleteId = $postValues['busid'];	
		   //die($deleteId);
		   $busObj->setBusOrderId($deleteId);
		   if($busObj->deleteBookingOrder()) {
			    $this->template->setVariable([
				    'DELETED'    => "sucessfully deleted"
				]); 
				$this->template->parse('show_booking_deleted');	
           }			
        }			
		return $this->template->get();
    }

}