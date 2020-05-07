<?php
namespace bookingsystem\Controller;
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);
class BookingController {
    protected $template;
    protected $request;

    public function __construct($request)
    {
        $this->request =  $request;
        $this->template = clone $request->getTemplate();
    }
	
    public function search()
    {
        $this->template->loadTemplateFile('search.html');  
        $postValues = $this->request->getPostParams();
		$city  = new \BookingSystem\Model\Entity\City();
		$busObj = new \BookingSystem\Model\Entity\Bus();
		$results =  $city->getAll();		
        //$this->template->hideBlock('tab'); 		
        foreach ($results as $sources) {
            $selected = isset($postValues['source']) && $postValues['source'] == $sources->getCityName() ? 'selected' : '';
            $this->template->setVariable([
                'SOURCE_ID'       => $sources->getId(),
                'SOURCE_NAME'     => $sources->getCityName(),
                'SOURCE_SELECTED' => $selected
            ]);
            $this->template->parse('show_source');
        }
        foreach ($results as $destination) {
            $selected = isset($postValues['destination']) && $postValues['destination'] == $destination->getCityName() ? 'selected' : '';
            $this->template->setVariable([
                'DESTINATION_ID'       => $destination->getId(),
                'DESTINATION_NAME'     => $destination->getCityName(),
                'DESTINATION_SELECTED' => $selected
            ]);
            $this->template->parse('show_destination');
        }
		$heading = "search buses";
		
        $this->template->show('head');
		if (isset($postValues['submit'])) {
			$this->template->setVariable([
						'HEAD'            => "bus Id"
			]);
			$this->template->parse('tab'); 
			$this->template->hideBlock('head');
			//die($_SESSION["id"]);
			$from = $postValues['source'];
			$to = $postValues['destination'];
			$date = $postValues['trip'];
			$route = $from."-".$to;
			$buses   = $busObj->getAll();
            foreach ($buses as $bus) {
				if ($route == $bus->getRoute()->getRouteName()) {
					$busId = $bus->getId();
					$bus->setBusBookingId($busId);
					$bus->setJourneyDate($date);
					$bus->setTicketBookingUserId($_SESSION["id"]);
					$bus->getBusOrder();
					$bookedSeats = $bus->getSeatNumbers();
					//die($bookedSeats);
					$this->template->setVariable([
						'ID'            => $bus->getId(),
						'BUS_NUMBER'    => $bus->getBusNumber(),
						'STATUS'        => $bus->getStatus(),
						'COACH_TYPE'    => $bus->getCoachType()->getCoachName(), 
						'ROUTE_NAME'    => $bus->getRoute()->getRouteName(),
						'SOURCE'        => $bus->getRoute()->getSource()->getCityName(),
						'DESTINATION'   => $bus->getRoute()->getDestination()->getCityName(),
						'START_TIME'    => $bus->getRoute()->getStartTime(),
						'JOURNEY_TIME'  => $bus->getRoute()->getJourneyTime(),
						'PRICE'         => $bus->getRoute()->getPrice(),
						'RATING'        => $bus->getRating(),
				        'AGENCY_NAME'   => $bus->getTravelAgency()->getAgencyName(),
						'AGENCY_NUMBER' => $bus->getTravelAgency()->getPhoneNumber(),
						'AGENCY_ADDRESS'=> $bus->getTravelAgency()->getOfficeAddress(),
						'SEAT_ID'       => $bus->getId(),
						'BOOKED_SEATS'  => $bookedSeats,
						'SELECTED_DATE' => !empty($date) ? $date : ''
					]);
					$this->template->parse('data');
				}				
			}
        }
		if(isset($postValues['book'])) {
			$arr = [];
			
			 if(isset($postValues['1A'])) {
				array_push($arr,"1A");
			 }	
			 if(isset($postValues['1B'])) {
				   array_push($arr,"1B");
			 }
			 if(isset($postValues['1C'])) {
				array_push($arr,"1C");
			 }	 
			 if(isset($postValues['1D'])) {
				 array_push($arr,"1D");
			 }
			 if(isset($postValues['2A'])) {
				array_push($arr,"2A");
			 }	
			 if(isset($postValues['2B'])) {
				   array_push($arr,"2B");
			 }
			 if(isset($postValues['2C'])) {
				array_push($arr,"2C");
			 }	 
			 if(isset($postValues['2D'])) {
				 array_push($arr,"2D");
			 }
			 if(isset($postValues['3A'])) {
				array_push($arr,"3A");
			 }	
			 if(isset($postValues['3B'])) {
				   array_push($arr,"3B");
			 }
			 if(isset($postValues['3C'])) {
				array_push($arr,"3C");
			 }	 
			 if(isset($postValues['3D'])) {
				 array_push($arr,"1D");
			 }
			 if(isset($postValues['4A'])) {
				array_push($arr,"4A");
			 }	
			 if(isset($postValues['4B'])) {
				   array_push($arr,"4B");
			 }
			 if(isset($postValues['4C'])) {
				array_push($arr,"4C");
			 }	 
			 if(isset($postValues['4D'])) {
				 array_push($arr,"4D");
			 }
			 if(isset($postValues['5A'])) {
				array_push($arr,"5A");
			 }	
			 if(isset($postValues['5B'])) {
				   array_push($arr,"5B");
			 }
			 if(isset($postValues['5C'])) {
				array_push($arr,"5C");
			 }	 
			 if(isset($postValues['5D'])) {
				 array_push($arr,"5D");
			 }
			 if(isset($postValues['6A'])) {
				array_push($arr,"6A");
			 }	
			 if(isset($postValues['6B'])) {
				   array_push($arr,"6B");
			 }
			 if(isset($postValues['6C'])) {
				array_push($arr,"6C");
			 }	 
			 if(isset($postValues['6D'])) {
				 array_push($arr,"6D");
			 }
			 if(isset($postValues['7A'])) {
				array_push($arr,"7A");
			 }	
			 if(isset($postValues['7B'])) {
				   array_push($arr,"7B");
			 }
			 if(isset($postValues['7C'])) {
				array_push($arr,"7C");
			 }	 
			 if(isset($postValues['7D'])) {
				 array_push($arr,"7D");
			 }
			 if(isset($postValues['8A'])) {
				array_push($arr,"8A");
			 }	
			 if(isset($postValues['8B'])) {
				   array_push($arr,"8B");
			 }
			 if(isset($postValues['8C'])) {
				array_push($arr,"8C");
			 }	 
			 if(isset($postValues['8D'])) {
				 array_push($arr,"8D");
			 }
			
			
			
			$busId = $postValues['selected-seat-id'];
			$busObj->setId($busId);
			$busObj->getById();
			$selectedAmount =  $busObj->getRoute()->getPrice();
			$date = $postValues['selected-date'];
			$seatArr = sizeof($arr);
			$totalPrice = $selectedAmount*$seatArr;
			$seatsInArr = implode(",",$arr);
				
			
			if(isset($postValues['book'])){
				$this->template->hideBlock('head');
				//$this->template->hideBlock('seats');
				$this->template->setVariable([
							'BUS_BOOKING_ID'      => $busId,
							'BUS_BOOKING_DATE'    => $date,
							'TOTAL_AMOUNT'        => $totalPrice,
							'PASSENGER_COUNT'     => $seatArr,
							'SEATS_NUMBERS'       => $seatsInArr
				]); 
				$this->template->show('show_conform_booking');
			}	
         
        }
			if(isset($postValues['conform'])){
				$busObj->setBusBookingId($postValues['selected-id']);
				$busObj->setJourneyDate($postValues['selected-date']);
				$busObj->setSeatNumbers($postValues['selected-seats']);
				$busObj->setPassengerCount($postValues['selected-passcount']);
				$busObj->setTotalAmount($postValues['selected-amount']);
				$busObj->setTicketBookingUserId($_SESSION["id"]);
				$busObj->setTicketBookingDate(date("Y/m/d"));
				
				if($busObj->setBusOrder()){
					header('Location: http://www.busbooking.local/?module=myBooking&msg=conformbooking');		
				}	
			}
			
			
		return $this->template->get();
    }
		
    
		
} 