package com.example.demo2.farmerconnect;

import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.Map;

@RestController
public class AgentRestController {
    AreaDB areaDB= new AreaDB();
    Area_T areaT= new Area_T();

    @PostMapping("/api/AreaInsertion")
    public ResponseEntity<String> handleFormSubmission(@RequestBody Map<String,Object > payload) {
        try {

            String area_code = (String) payload.get("areaCode");
            String area_name = (String) payload.get("areaLocation");
            areaT.setArea_code(area_code);
            areaT.setArea_location(area_name);


            if (area_code != null && area_code.matches("^[A-Za-z0-9]{6}$")) {
                areaDB.save_area_data(areaT);
                return ResponseEntity.ok("Data saved successfully!");
            }
            else {
                return ResponseEntity.ok("area code must be in 6 letters!");
            }
        } catch (Exception e) {

            return ResponseEntity.status(500).body("Failed to save data.");
        }



}
}


