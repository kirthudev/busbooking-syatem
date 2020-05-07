<?php
namespace BookingSystem\Model\Entity;

class Bus {
    protected $id;
    protected $busNumber;
    protected $coachType;
    protected $status;
    protected $route=[];
    protected $travelAgency;
    protected $rating;
    protected $agencyId;
	protected $busBookingId;
	protected $totalAmount;
	protected $journeyDate;
	protected $seatNumbers;
	protected $passengerCount;
	protected $isPaid;
	protected $ticketBookingDate;
	protected $ticketBookingUserId;
	protected $busOrderId;

    public function __construct($id = 0)
    {
        if (!empty($id)) {
            $this->id = $id;
            $this->get(); 		
        }
    }
	
	public function setId($id)
    {
       $this->id = $id;
    }
	
    public function getId()
    {
        return $this->id;
    }
	
	public function setBusBookingId($busBookingId)
    {
         $this->busBookingId = $busBookingId;
    }
    
    public function getBusBookingId()
    {
        return $this->busBookingId;
    }
	
	public function setBusOrderId($busOrderId)
    {
         $this->busOrderId = $busOrderId;
    }
    
    public function getBusBOrderId()
    {
        return $this->busOrderId;
    }
	
	public function setTicketBookingDate($ticketBookingDate)
    {
         $this->ticketBookingDate = $ticketBookingDate;
    }
    
    public function getTicketBookingDate()
    {
        return $this->ticketBookingDate;
    }
	
	public function setTicketBookingUserId($ticketBookingUserId)
    {
         $this->ticketBookingUserId = $ticketBookingUserId;
    }
    
    public function getTicketBookingUserId()
    {
        return $this->ticketBookingUserId;
    }
	
	public function setPassengerCount($passengerCount)
    {
         $this->passengerCount = $passengerCount;
    }
    
    public function getPassengerCount()
    {
        return $this->passengerCount;
    }
	
	public function setIsPaid($isPaid)
    {
         $this->isPaid = $isPaid;
    }
    
    public function getIsPaid()
    {
        return $this->isPaid;
    }
	
	public function setTotalAmount($totalAmount)
    {
         $this->totalAmount = $totalAmount;
    }
    
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }
	
	public function setJourneyDate($journeyDate)
    {
         $this->journeyDate = $journeyDate;
    }
    
    public function getJourneyDate()
    {
        return $this->journeyDate;
    }
	
	public function setSeatNumbers($seatNumbers)
    {
         $this->seatNumbers = $seatNumbers;
    }
    
    public function getSeatNumbers()
    {
        return $this->seatNumbers;
    }
    
    
    public function setAgencyId($agencyId)
    {
         $this->agencyId = $agencyId;
    }
    
    public function getAgencyId()
    {
        return $this->agencyId;
    }
    
    public function setBusNumber($busNumber)
    {
        $this->busNumber = $busNumber;
    }

    public function getBusNumber()
    {
        return $this->busNumber;
    }
    
    public function setCoachType($coachType)
    {
        $this->coachType = $coachType;
    }

    public function getCoachType()
    {
        return $this->coachType;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
    
    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }
    
    public function setTravelAgency($travelAgency)
    {
        $this->travelAgency = $travelAgency;
    }

    public function getTravelAgency()
    {
        return $this->travelAgency;
    }
    
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function getRating()
    {
        return $this->rating;
    }
    
    public function Validate() {
        if(empty($this->busNumber)||empty($this->route||empty($this->rating)||empty($this->route||empty($this->coachType)||empty($this->travelAgency)))) {
            $this->errors[] = 'Fill Mandatory Field * ';
        }
        return (bool) empty($this->errors);
    }
    
    public function save() 
    {
        if (!$this->validate()) {
            return false;
        }
        $sql = (empty($this->id) ? 'INSERT INTO' : 'UPDATE') . ' `bues`
            SET bus_number       = "' . $this->busNumber . '",
                status           = "' . $this->status . '",
                coach_type       = "' . $this->coachType . '",
                route            = "' . $this->route . '",  
                rating           = "' . $this->rating . '",     
                travel_agency    = "' . $this->travelAgency . '"' .
                (!empty($this->id) ? 'WHERE `id` = ' . $this->id : '');
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        if (!$result) {
            $this->errors[] = 'Failed to ' . (empty($this->id) ? 'store' : 'update') . ' the  data.';
        }
        return $result;
    }  
    
    public function get()
    {
        if (empty($this->id)) {
            return false;
        }
        $sql    = 'SELECT * FROM `bues` WHERE `id` = ' . $this->id;
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        if ($result->num_rows != 1) {
            $this->errors[] = 'Bus not exists.';
            return false;
        }
        //die($sql);
        $bus = $result->fetch_assoc();
        $this->id            = $bus['id'];
        $this->busNumber     = $bus['bus_number'];
        $this->status        = $bus['status'];
        $this->coachType     = new Coach($bus['coach_type']);
        $this->route         = new Route($bus['route']);
        $this->rating        = $bus['rating'];
        $this->travelAgency  = new Agency($bus['travel_agency']);
        return true;
    }        
	
	public function getById()
    {
        if (empty($this->id)) {
            return false;
        }
        $sql    = 'SELECT * FROM `bues` WHERE `id` = ' . $this->id;
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        if ($result->num_rows != 1) {
            $this->errors[] = 'Bus not exists.';
            return false;
        }
        //$die($sql);
        $bus = $result->fetch_assoc();
        $this->id            = $bus['id'];
        $this->busNumber     = $bus['bus_number'];
        $this->status        = $bus['status'];
        $this->coachType     = new Coach($bus['coach_type']);
        $this->route         = new Route($bus['route']);
        $this->rating        = $bus['rating'];
        $this->travelAgency  = new Agency($bus['travel_agency']);
        return true;
    }

    public function delete()
    {
        if (empty($this->id)) {
            return false;
        }
        return \bookingsystem\Config\Db::getInstance()->query(
            'DELETE FROM `bues` WHERE `id` = ' . $this->id
        ); 
    }     
    
    public function getAll() 
    {
        $sql = 'SELECT * FROM  `bues` ' .
                (!empty($this->agencyId) ? 'WHERE `travel_agency` = ' . $this->agencyId : '');
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        //die($sql);
        $resultArray = [];
         while ($row = $result->fetch_assoc()) {
            $resultArray[] = new Bus($row['id']);
        }
        return $resultArray;
    }  
	
	public function SetBusorder() 
	{
		
	   $sql = ' INSERT INTO  `bus_order`
						SET bus_id          = "' . $this->busBookingId . '",
							journey_date     = "' .$this->journeyDate . '",
							amount          = "' . $this->totalAmount . '",
							passenger_count = "' . $this->passengerCount  . '",
							is_paid         = "' . true . '",
							booking_date    = "' . $this->ticketBookingDate . '",
							passenger_id    = "' . $this->ticketBookingUserId . '",
							seat_numbers    = "' . $this->seatNumbers . '"
						';		
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
		//die($sql);
        if (!$result) {
            $this->errors[] = 'Failed to ' . (empty($this->id) ? 'store' : 'update') . ' the  data.';
        }
        return $result;
	}	
	
	public function getBusOrder()
    {
        $sql    = 'SELECT `seat_numbers` FROM `bus_order` WHERE `bus_id` = ' . $this->id . ' AND `passenger_id` = ' . $this->ticketBookingUserId . ' AND `journey_date` = "' . $this->journeyDate . '"';
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        //die($sql);
        if ($result->num_rows != 1) {
            $this->errors[] = 'Bus not exists.';
            return false;
        }
        $bus = $result->fetch_assoc();
        //$this->busBookingId          = $bus['bus_id '];
        //$this->journeyDate           = $bus['journey_date'];
        //$this->totalAmount           = $bus['amount'];
        //$this->ticketBookingDate     = $bus['booking_date'];
        //$this->ticketBookingUserId   = $bus['passenger_id'];
        $this->seatNumbers           = $bus['seat_numbers'];
		
        return true;
    }	
	
	public function getAllMyBookings()
	{
		 $sql = 'SELECT * FROM  `bus_order` WHERE `passenger_id` = ' . $this->ticketBookingUserId ;
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        //die($sql);
        $resultArray = [];
         while ($row = $result->fetch_assoc()) {
            $resultArray[] = $row['id'];
        }
        return $resultArray;
		
        return true;
	}
	
	public function  allIdBookings()
	{
		$sql = 'SELECT * FROM  `bus_order`' ;
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        //die($sql);
        $resultArray = [];
         while ($row = $result->fetch_assoc()) {
            $resultArray[] = $row['id'];
        }
        return $resultArray;
		
        return true;
	}	
	
	public function getMyBooking()
    {
        $sql    = 'SELECT * FROM `bus_order` WHERE `id` = ' . $this->busOrderId ;
        $result = \bookingsystem\Config\Db::getInstance()->query($sql);
        //die($sql);
        if ($result->num_rows != 1) {
            $this->errors[] = 'Bus not exists.';
            return false;
        }
        $row = $result->fetch_assoc();
		
        $this->busBookingId          = $row['bus_id'];
        $this->journeyDate           = $row['journey_date'];
        $this->totalAmount           = $row['amount'];
        $this->ticketBookingDate     = $row['booking_date'];
		$this->passengerCount        = $row['passenger_count'];
        $this->ticketBookingUserId   = $row['passenger_id'];
        $this->seatNumbers           = $row['seat_numbers'];
		
        return true;
    }
    
   	public function deleteBookingOrder()
    {
        
		$sql = 'DELETE FROM `bus_order` WHERE `id` = ' . $this->busOrderId ;
		//die($sql);
        return \bookingsystem\Config\Db::getInstance()->query($sql); 
    }
	
	

}         
