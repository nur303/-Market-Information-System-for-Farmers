package com.example.demo2.farmerconnect;

import com.fasterxml.jackson.annotation.JsonFormat;
import lombok.Data;

import java.time.LocalDate;

@Data
public class MarketPriceGraph {
    @JsonFormat(pattern = "yyyy-MM-dd") // Ensure consistent update_date format

    private LocalDate update_date;
    private int price;

    public MarketPriceGraph(LocalDate update_date, int price) {
        this.update_date = update_date;
        this.price = price;
    }

    // Constructors, getters, and setters
}

