package com.example.agile_tech;

import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import com.google.android.material.snackbar.Snackbar;
import com.google.android.material.textfield.TextInputEditText;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity {
    ProgressBar progress_bar;
    TextInputEditText email, password;
    Button login, button;
//    TextInputLayout error;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        button = findViewById(R.id.sign);
        progress_bar = findViewById(R.id.login_progress_bar);
        email = findViewById(R.id.login_email);
        password = findViewById(R.id.login_password);
        login = findViewById(R.id.login);
//        error=findViewById(R.id.email_error);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, Register.class);
                startActivity(intent);
            }
        });
        login.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                String emailPattern = "[a-zA-Z0-9._-]+@[a-z]+\\.+[a-z]+";

                if (!email.getText().toString().matches(emailPattern)) {
                    email.setError("Enter valid email id");
//                    error.setBoxStrokeColor(getResources().getColor(R.color.red));
                } else if (password.getText().toString().isEmpty()) {
                    password.setError("Please enter you password");
//                    passwordToast.makeText(MainActivity.this, "Please enter your password", Toast.LENGTH_SHORT).show();

                } else {
                    post(email.getText().toString(), password.getText().toString());
                }
            }


        });


    }

    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)
    private void post(String Login_Email, String Login_Password) {
        progress_bar.setVisibility(View.VISIBLE);
        RetrofitApi retrofit = apiclient.getApi();

        Call<DataModal> log = retrofit.login(Login_Email, Login_Password);
        log.enqueue(new Callback<DataModal>() {
            @Override
            public void onResponse(Call<DataModal> call, Response<DataModal> response) {
                //   Toast.makeText(MainActivity.this, response.body().response, Toast.LENGTH_SHORT).show();
                progress_bar.setVisibility(View.GONE);
                if (response.body().response.equals("Successfully login")) {
                    Toast.makeText(MainActivity.this, "Successfully login", Toast.LENGTH_SHORT).show();

                    Intent intent1 = new Intent(MainActivity.this, HomeActivity.class);
                    startActivity(intent1);

                } else {

                    Snackbar snackbar = Snackbar.make(findViewById(android.R.id.content),response.body().response, Snackbar.LENGTH_LONG);
//                    snackbar.setAction("OK", new View.OnClickListener() {
//                        @Override
//                        public void onClick(View v) {
//
//                        }
//                    });
                    snackbar.show();

                }

            }


            @Override
            public void onFailure(Call<DataModal> call, Throwable t) {

                Toast.makeText(MainActivity.this, t.toString(), Toast.LENGTH_SHORT).show();
                progress_bar.setVisibility(View.GONE);

            }
        });
    }
}






