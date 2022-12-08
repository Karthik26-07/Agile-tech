package com.example.agile_tech.ui.attedence;

import android.Manifest;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationManager;
import android.os.Build;
import android.os.Bundle;
import android.os.Looper;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AlertDialog;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.agile_tech.AttendanceModal;
import com.example.agile_tech.DataModal;
import com.example.agile_tech.R;
import com.example.agile_tech.RetrofitApi;
import com.example.agile_tech.apiclient;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationCallback;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationResult;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.location.Priority;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Attendance extends Fragment {

    Button next;
    int flag = 0;
    String latitude = "";
    String longitude = "";
    boolean loc_enabled = true;
    private FusedLocationProviderClient mFusedLocationProvderClient;
    RadioGroup radioGroup;

    String radio;
    RecyclerView recyclerView;
    LinearLayoutManager linearLayoutManager;
    AttendanceAdapter attendanceAdapter;


    // View fragment
    @RequiresApi(api = Build.VERSION_CODES.M)
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.attendance, container, false);
        getLocation();
        if (loc_enabled) {
            isLocationEnabled();
        }
        next = v.findViewById(R.id.next_page);
        radioGroup = v.findViewById(R.id.radio);
        recyclerView = v.findViewById(R.id.recyclerView);
        attendance();
        return v;
    }

    //for turn on the device location while application is running
    private void turnOnLocation() {
        AlertDialog.Builder builder = new AlertDialog.Builder(getContext());
        builder.setMessage("Please turn on your device location");
        builder.setTitle("Alert !");
        builder.setCancelable(false);
        builder.setPositiveButton("Yes", (DialogInterface.OnClickListener) (dialog, which) -> {
            startActivity(new Intent(android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS));
        });
        builder.setNegativeButton("No", (DialogInterface.OnClickListener) (dialog, which) -> {
            dialog.cancel();
        });
        AlertDialog alertDialog = builder.create();
        alertDialog.show();
    }

    // Asking permission for location access
    @RequiresApi(api = Build.VERSION_CODES.M)
    private void getLocation() {
        if (ContextCompat.checkSelfPermission(getContext(), Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(getActivity(), new String[]{android.Manifest.permission.ACCESS_FINE_LOCATION}, 100);
        } else {
            if (loc_enabled) {
                LocationRequest locationRequest = new LocationRequest.Builder(Priority.PRIORITY_HIGH_ACCURACY, 5)
                        .setWaitForAccurateLocation(false)
                        .setMinUpdateIntervalMillis(0)
                        .setMaxUpdateDelayMillis(100)
                        .build();
                mFusedLocationProvderClient = LocationServices.getFusedLocationProviderClient(getContext());
                mFusedLocationProvderClient.requestLocationUpdates(locationRequest, mLocationCallback, Looper.myLooper());
            } else {
                loc_enabled = isLocationEnabled();
            }
        }
    }

    private LocationCallback mLocationCallback = new LocationCallback() {
        @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)
        @Override
        public void onLocationResult(@NonNull LocationResult locationResult) {
            Location mLastLocation = locationResult.getLastLocation();
            latitude = Double.toString(mLastLocation.getLatitude());
            longitude = Double.toString(mLastLocation.getLongitude());
//            Toast.makeText(getContext(), latitude, Toast.LENGTH_SHORT).show();
//            Toast.makeText(getContext(), longitude, Toast.LENGTH_SHORT).show();
            location();
        }
    };


    //Checking the device location is active or not
    @RequiresApi(api = Build.VERSION_CODES.M)
    private boolean isLocationEnabled() {

        LocationManager locationManager = (LocationManager) getContext().getSystemService(getContext().LOCATION_SERVICE);
        if (locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
            location();
            return true;

        } else {
            turnOnLocation();
            return false;
        }
    }


    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)
    public void location() {
        if (latitude.equals("") && longitude.equals("")) {

            Toast.makeText(getContext(), "Waiting for location", Toast.LENGTH_SHORT).show();
        } else {
            if (flag == 0) {
                sendlocation(latitude, longitude);
                flag = 1;
            } else {
//                Toast.makeText(getContext(), " location", Toast.LENGTH_SHORT).show();

            }
        }
    }

    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)
    private void sendlocation(String latitude, String longitude) {
        RetrofitApi retrofit = apiclient.getApi();
        Call<DataModal> loc = retrofit.location(latitude, longitude);
        loc.enqueue(new Callback<DataModal>() {
            @Override
            public void onResponse(@NonNull Call<DataModal> call, @NonNull Response<DataModal> response) {
//                Toast.makeText(getContext(), response.body().response, Toast.LENGTH_SHORT).show();
                AlertDialog.Builder builder = new AlertDialog.Builder(getContext());
                builder.setMessage(response.body().response);
                builder.setTitle("Alert !");
                builder.setCancelable(false);
                builder.setPositiveButton("OK", (DialogInterface.OnClickListener) (dialog, which) -> {

                });
                AlertDialog alertDialog = builder.create();
                alertDialog.show();
                next.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {

                        if (response.body().response.equals("Put your attendance")) {
                            int selectedId = radioGroup.getCheckedRadioButtonId();

                            // find the radiobutton by returned id
//                            radioButton = radioGroup.findViewById(selectedId);

                            switch (selectedId) {
                                case R.id.first_half:
                                    radio = "First half";
                                    break;
                                case R.id.second_half:
                                    radio = "Second half";
                                    break;
                            }

                            Call<DataModal> attendance = retrofit.put_Attendance(radio);
                            attendance.enqueue(new Callback<DataModal>() {
                                @Override
                                public void onResponse(Call<DataModal> call, Response<DataModal> response) {
                                    Toast.makeText(getContext(), response.body().response, Toast.LENGTH_SHORT).show();
                                }

                                @Override
                                public void onFailure(Call<DataModal> call, Throwable t) {
                                    Toast.makeText(getContext(), t.toString(), Toast.LENGTH_SHORT).show();

                                }
                            });

                        } else {
                            Toast.makeText(getContext(), "you are away from the location", Toast.LENGTH_SHORT).show();

                        }


                    }
                });
            }

            @Override
            public void onFailure(Call<DataModal> call, Throwable t) {
                Toast.makeText(getContext(), t.toString(), Toast.LENGTH_SHORT).show();

            }
        });
    }

    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)
    public void attendance() {
        RetrofitApi retrofit = apiclient.getApi();
        Call<List<AttendanceModal>> attend = retrofit.get_Attendance();
        attend.enqueue(new Callback<List<AttendanceModal>>() {
            @RequiresApi(api = Build.VERSION_CODES.N)
            @Override
            public void onResponse(Call<List<AttendanceModal>> call, Response<List<AttendanceModal>> response) {
                linearLayoutManager = new LinearLayoutManager(getContext());
                recyclerView.setLayoutManager(linearLayoutManager);
                attendanceAdapter = new AttendanceAdapter(response.body(), getContext());
                recyclerView.setAdapter(attendanceAdapter);
            }

            @Override
            public void onFailure(Call<List<AttendanceModal>> call, Throwable t) {
                Toast.makeText(getContext(), t.toString(), Toast.LENGTH_SHORT).show();

            }
        });
    }


}





