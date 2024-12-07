package com.example.demo2.farmerconnect;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface UserDataBase  extends JpaRepository<TargetUser_T,String> {
    TargetUser_T findByUserName(String userName);

}
