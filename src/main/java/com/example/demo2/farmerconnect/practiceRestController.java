package com.example.demo2.farmerconnect;


import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Map;

import static java.lang.Integer.parseInt;

@RestController
    public class practiceRestController {
        @PostMapping("api/submit-form")
        public ResponseEntity<String> handleFormSubmission(@RequestBody PracticeModelClass formData) {
            // Log the received data in the console
            System.out.println("Received Form Data: " + formData);
            System.out.println(formData.getAge());
            // Return a success response
            return ResponseEntity.ok("Form data received successfully!");
        }
    }


