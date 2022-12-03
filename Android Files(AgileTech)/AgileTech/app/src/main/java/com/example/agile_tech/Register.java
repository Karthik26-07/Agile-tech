package com.example.agile_tech;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.google.android.material.textfield.TextInputEditText;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Register extends AppCompatActivity {
    ProgressBar progress;
    TextInputEditText f_name, l_name, contact, email, password;
    Button button, button1, save;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        f_name = findViewById(R.id.first_name);
        l_name = findViewById(R.id.last_name);
        contact = findViewById(R.id.Contact_number);
        email = findViewById(R.id.Email_id);
        password = findViewById(R.id.Password);
        progress = (ProgressBar) findViewById(R.id.progress_bar);
        save = (Button) findViewById(R.id.save);

        button1 = (Button) findViewById(R.id.back_login);
        button = (Button) findViewById(R.id.login);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Register.this, MainActivity.class);
                startActivity(intent);
            }
        });
        button1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent1 = new Intent(Register.this, MainActivity.class);
                startActivity(intent1);
            }
        });
        save.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                String emailPattern = "[a-zA-Z0-9._-]+@[a-z]+\\.+[a-z]+";
                if (f_name.getText().toString().isEmpty()) {
                    f_name.setError("Enter your first name");
//                    Toast.makeText(Register.this, "Please enter your first name", Toast.LENGTH_SHORT).show();
                } else if (l_name.getText().toString().isEmpty()) {
                    l_name.setError("Enter your last name");
//                    Toast.makeText(Register.this, "Please enter your last name", Toast.LENGTH_SHORT).show();
                } else if (contact.getText().toString().length() != 10) {
                    contact.setError("Enter valid phone number");
//                    Toast.makeText(Register.this, "Please enter your phone number", Toast.LENGTH_SHORT).show();


                } else if (!email.getText().toString().matches(emailPattern)) {
                    email.setError("Enter valid email id");


//                    Toast.makeText(Register.this, "Please enter your email", Toast.LENGTH_SHORT).show();
                } else if (password.getText().toString().isEmpty()) {
                    password.setError("Enter the password");
//                    Toast.makeText(Register.this, "Please enter your password", Toast.LENGTH_SHORT).show();

                } else {
                    postData(f_name.getText().toString(), l_name.getText().toString(), contact.getText().toString(), email.getText().toString(), password.getText().toString());
                }
            }


        });
    }

    private void postData(String FirstName, String LastName, String Contact, String Email, String Password) {
        progress.setVisibility(View.VISIBLE);
        RetrofitApi retrofit = apiclient.getApi();

        Call<DataModal> call = retrofit.createPost(FirstName, LastName, Contact, Email, Password);
        call.enqueue(new Callback<DataModal>() {
            @Override
            public void onResponse(Call<DataModal> call, Response<DataModal> response) {
                Toast.makeText(Register.this, response.body().response, Toast.LENGTH_SHORT).show();
                // below line is for hiding our progress bar.
                progress.setVisibility(View.GONE);
                Intent intent = new Intent(Register.this, MainActivity.class);
                startActivity(intent);
            }

            @Override
            public void onFailure(Call<DataModal> call, Throwable t) {
                Toast.makeText(Register.this, t.toString(), Toast.LENGTH_SHORT).show();
            }
        });


    }


}
