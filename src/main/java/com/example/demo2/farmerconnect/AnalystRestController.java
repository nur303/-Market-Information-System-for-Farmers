package com.example.demo2.farmerconnect;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.sql.*;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

@RestController
public class AnalystRestController {
    AnalystMarketPriceAndAdvisedRates_T marketDataInput = new AnalystMarketPriceAndAdvisedRates_T();
    AnalystDB analystDB = new AnalystDB();
    Connection conn;
    {  // runs when an instance is created..
        try

        {
            conn = DriverManager.getConnection("jdbc:postgresql://localhost:5432/FarmerConnect_Group23",
                    "postgres",
                    "12345");
        } catch(
                SQLException ex)

        {
            throw new RuntimeException(ex);
        }
    }

    @RequestMapping("/api/pricing-graph")
    public ResponseEntity<?> getPricingGraph(
            @RequestParam String location,
            @RequestParam String crop,
            @RequestParam String month) {

        String startOfMonth = month + "-01";
        LocalDate startDate = LocalDate.parse(startOfMonth);
        LocalDate endDate = startDate.plusMonths(1);

        String sql = "SELECT update_date, highest_price_per_kg_or_unit " +
                "FROM MARKET_PRICE_FOR_CROPS_AND_ADVISED_RATES_T " +
                "WHERE area_code = ? AND cropID = ? " +
                "AND update_date >= ? AND update_date < ?";

        List<MarketPriceGraph> marketPriceGraphList = new ArrayList<>();

        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, location);
            ps.setString(2, crop);
            ps.setDate(3, Date.valueOf(startDate));
            ps.setDate(4, Date.valueOf(endDate));

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                LocalDate date = rs.getDate("update_date").toLocalDate();
                int price = rs.getInt("highest_price_per_kg_or_unit");

                marketPriceGraphList.add(new MarketPriceGraph(date, price));
            }

            return ResponseEntity.ok(marketPriceGraphList);
        } catch (SQLException e) {
            e.printStackTrace();
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(Map.of("error", "Failed to fetch pricing data", "message", e.getMessage()));
        }
    }

    @PostMapping("/api/AnalystInputForm")
    public ResponseEntity<String> handleFormSubmission(@RequestBody Map<String,Object >inputData) {
        try {
            System.out.println("Received Input Data: " + inputData);
            // saving data to handle class :
            marketDataInput.setCropID((String)inputData.get("crop"));
            System.out.println(marketDataInput.getCropID());
            marketDataInput.setAreaCode((String)inputData.get("location"));
            System.out.println(marketDataInput.getAreaCode());
            marketDataInput.setCurrent_supply_status((String)inputData.get("supplyStatus"));
            System.out.println(marketDataInput.getCurrent_supply_status());
            marketDataInput.setReason_for_advised_rate( (String)inputData.get("reason"));
            System.out.println(marketDataInput.getReason_for_advised_rate());
            marketDataInput.setCurrent_demand_status((String)inputData.get("demandStatus"));
            System.out.println(marketDataInput.getCurrent_demand_status());

            // Convert expectedPrice, highestPrice, and lowestPrice to Integer
            Object expectedPriceObj = inputData.get("expectedPrice");
            Object highestPriceObj = inputData.get("highestPrice");
            Object lowestPriceObj = inputData.get("lowestPrice");

            if (expectedPriceObj != null) {
                marketDataInput.setExpected_price_after_week_tk_per_kg(
                        Integer.parseInt(expectedPriceObj.toString()));
            }
            if (highestPriceObj != null) {
                marketDataInput.setHighestPricePerKgOrUnit(
                        Integer.parseInt(highestPriceObj.toString()));
            }
            if (lowestPriceObj != null) {
                marketDataInput.setLowestPricePerKgOrUnit(
                        Integer.parseInt(lowestPriceObj.toString()));
            }
            System.out.println(marketDataInput.getExpected_price_after_week_tk_per_kg());
            System.out.println(marketDataInput.getHighestPricePerKgOrUnit());
            System.out.println(marketDataInput.getLowestPricePerKgOrUnit());
            analystDB.save_market_data(marketDataInput);

            return ResponseEntity.ok("Data saved successfully!");
        } catch (Exception e) {

            return ResponseEntity.status(500).body("Failed to save data.");
        }
    }
}
