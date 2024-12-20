package com.example.demo2.farmerconnect;

import lombok.AllArgsConstructor;
import lombok.Data;

import java.sql.Date;

@Data
@AllArgsConstructor
public class Harvest_T {

 // Auto-generate primary key
    private int harvestId ; // Harvest_T ID (auto-generated)
    private Date update_date;
    private int farmerID; // Farmer ID from the dropdown
    private String cropID; // Crop name or ID
    private String area_code; // Location area code
    private int inStock; // In-stock percentage
    private int quantity; // Quantity of crops (kgs)
    private String quality; // Quality of the crops
    private int askingPrice; // Asking price

    private String farmerName;
    private String cropName;
    private String location;
    // Default constructor
    public Harvest_T() {}

 public Harvest_T(String area_code, int askingPrice, String cropID, int farmerID, int inStock, String quality, int quantity) {
  this.area_code = area_code;
  this.askingPrice = askingPrice;
  this.cropID = cropID;
  this.farmerID = farmerID;
  this.inStock = inStock;
  this.quality = quality;
  this.quantity = quantity;
 }

    public Harvest_T(String location, String quality, int quantity, Date update_date, int inStock, String farmerName, int harvestId, String cropName, int askingPrice) {
        this.location = location;
        this.quality = quality;
        this.quantity = quantity;
        this.update_date = update_date;
        this.inStock = inStock;
        this.farmerName = farmerName;
        this.harvestId = harvestId;
        this.cropName = cropName;
        this.askingPrice = askingPrice;
    }


}
