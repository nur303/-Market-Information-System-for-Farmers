package com.example.demo2.farmerconnect;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import java.sql.*;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Map;

@RestController
public class PricingGraphController {

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
}
