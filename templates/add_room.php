
    <form class="w3-container" action="../app/add_room.php" method="POST">
    <p>      
        <label class="w3-text-blue"><b>Room Type</b></label>
        <select name="room_type" class="w3-input w3-border" required>
            <option value="">Select Room Type</option>
            <option value="Lec">Lecture Room</option>
            <option value="Lab">Laboratory Room</option>
        </select>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Room Name</b></label>
        <input type="text" name="room_name" class="w3-input w3-border" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Room Capacity</b></label>
        <input type="text" name="room_cap" class="w3-input w3-border" required>
    </p>  
    <p>      
        <label class="w3-text-blue"><b>Building Name</b></label>
        <input type="text" name="room_cap" class="w3-input w3-border" required>
    </p> 
    
    <br>
    <p>      
    <button class="w3-btn w3-blue">Add Room</button></p>
    </form>
