package com.example.demo2.farmerconnect;




import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

    @Controller
    public class PracticCrontroller {

        @GetMapping("/practice")
        public String showForm() {
            return "practice"; // Refers to simple-form.html in the templates directory
        }


        @GetMapping("/practiceDelete")
        public String showPracticePage() {
            return "PracticeDelete"; // This corresponds to practice.html in your templates folder
            }
        }




