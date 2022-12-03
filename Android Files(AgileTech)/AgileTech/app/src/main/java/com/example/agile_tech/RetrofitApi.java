package com.example.agile_tech;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface RetrofitApi {

    @FormUrlEncoded
    @POST("Register&login/Registration.php ")
    Call<DataModal> createPost(
            @Field("FirstName") String first_name,
            @Field("LastName") String last_name,
            @Field("Contact") String contact,
            @Field("Email") String email,
            @Field("Password") String password
    );

    @FormUrlEncoded
    @POST("Register&login/login.php ")
    Call<DataModal> login(
            @Field("Login_Email") String login_email,
            @Field("Login_Password") String login_password
    );


    @GET("Attendance/Attendance.php")
    Call<DataModal> location(
            @Query("Latitude") String latitude,
            @Query("Longitude") String longitude
    );

    @FormUrlEncoded
    @POST("Attendance/put_Attendance.php")
    Call<DataModal> put_Attendance(
            @Field("radio") String radio
    );

}
