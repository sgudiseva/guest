<?php
require_once ('DatabaseModel.php');


class GuestModel extends DatabaseModel
{
    
   private $table = "guest";
    /*
     * 
     * Add Guest
     */
    public function addGuest($data)
    {
        return $this->insert($this->table, $data);
    }
    
    /*
     * Add Guests
     * 
     */
    public function addGuests($data)
    {
        $guestIds = array();
        if (isset($data)) {
            foreach ($data as $id => $guest) {
              
                $guestIds[] = $this->addGuest($guest);
            }
        }
        
        return $guestIds;
    }
}
?>