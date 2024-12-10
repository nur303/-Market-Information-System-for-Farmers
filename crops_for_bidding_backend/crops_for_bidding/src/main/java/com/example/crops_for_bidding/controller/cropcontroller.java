package com.example.demo.controller;

import com.example.demo.model.Crop;
import com.example.demo.repository.CropRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/crops")
public class CropController {
    @Autowired
    private CropRepository cropRepository;

    @GetMapping
    public List<Crop> getAllCrops() {
        return cropRepository.findAll();
    }

    @PostMapping
    public Crop addCrop(@RequestBody Crop crop) {
        return cropRepository.save(crop);
    }
}