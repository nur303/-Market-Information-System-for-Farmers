package com.example.demo2.farmerconnect;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
public class PracticeDeleteController {

    // Save data (you can store it in a database or use a simple in-memory solution)
    @PostMapping("/api/save-data")
    public ResponseEntity<String> saveData(@RequestBody Data data) {
        System.out.println("Received Data: " + data);
        // Process the data here (e.g., save to database)
        return ResponseEntity.ok("Data saved successfully!");
    }

    // Delete data
    @DeleteMapping("/api/delete-data")
    public ResponseEntity<String> deleteData(@RequestBody Data data) {
        System.out.println("Deleting data: " + data);
        // Process the deletion here (e.g., remove from database)
        return ResponseEntity.ok("Data deleted successfully!");
    }

    // Data model to represent the data
    public static class Data {
        private int id;
        private String name;
        private String date;

        // Getters and setters
        public int getId() {
            return id;
        }

        public void setId(int id) {
            this.id = id;
        }

        public String getName() {
            return name;
        }

        public void setName(String name) {
            this.name = name;
        }

        public String getDate() {
            return date;
        }

        public void setDate(String date) {
            this.date = date;
        }

        @Override
        public String toString() {
            return "Data{id=" + id + ", name='" + name + "', date='" + date + "'}";
        }
    }
}
