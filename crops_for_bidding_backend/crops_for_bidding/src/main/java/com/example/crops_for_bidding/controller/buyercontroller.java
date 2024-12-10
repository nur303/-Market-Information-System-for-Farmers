package com.example.demo.controller;

import com.example.demo.model.Buyer;
import com.example.demo.repository.BuyerRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/buyers")
public class BuyerController {
    @Autowired
    private BuyerRepository buyerRepository;

    @GetMapping
    public List<Buyer> getAllBuyers() {
        return buyerRepository.findAll();
    }

    @PostMapping
    public Buyer addBuyer(@RequestBody Buyer buyer) {
        return buyerRepository.save(buyer);
    }
}