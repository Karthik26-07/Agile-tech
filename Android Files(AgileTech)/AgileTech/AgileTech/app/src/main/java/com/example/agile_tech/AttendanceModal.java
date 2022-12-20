package com.example.agile_tech;

import com.google.gson.annotations.SerializedName;

import java.io.Serializable;

public class AttendanceModal implements Serializable {

    @SerializedName("date")
   public String Date;
    @SerializedName("first_half")
   public String morning;
    @SerializedName("first_half_time")
     public String morning_time;
    @SerializedName("second_half")
     public String evening;
    @SerializedName("second_half_time")
    public String evening_time;


}
