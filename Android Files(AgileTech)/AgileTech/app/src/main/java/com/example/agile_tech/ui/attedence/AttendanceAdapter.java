package com.example.agile_tech.ui.attedence;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.agile_tech.AttendanceModal;
import com.example.agile_tech.R;

import java.util.List;

public class AttendanceAdapter extends RecyclerView.Adapter<AttendanceAdapter.viewHolder> {
    List<AttendanceModal> att;
    Context context;


    public AttendanceAdapter(List<AttendanceModal> att, Context context) {
        this.att = att;
        this.context = context;
    }


    @NonNull
    @Override
    public AttendanceAdapter.viewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.attendance_modal, parent, false);
        return new viewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull AttendanceAdapter.viewHolder holder, int position) {
        if (att.get(position).morning.equals("Present")) {
            holder.Morning_status.setTextColor(context.getResources().getColor(R.color.green));
        } else {
            holder.Morning_status.setTextColor(context.getResources().getColor(R.color.red));

        }
        if (att.get(position).evening.equals("Present")) {
            holder.Evening_status.setTextColor(context.getResources().getColor(R.color.green));
        } else {
            holder.Evening_status.setTextColor(context.getResources().getColor(R.color.red));

        }

        holder.att_date.setText(att.get(position).Date);
        holder.Morning_time.setText(att.get(position).morning_time);
        holder.Morning_status.setText(att.get(position).morning);

        holder.Evening_time.setText(att.get(position).evening_time);
        holder.Evening_status.setText(att.get(position).evening);


    }

    @Override
    public int getItemCount() {
        return att.size();
    }

    public class viewHolder extends RecyclerView.ViewHolder {
        TextView att_date;
        TextView Morning_time, Morning_status, Evening_time, Evening_status;

        public viewHolder(@NonNull View itemView) {
            super(itemView);
            att_date = itemView.findViewById(R.id.Att_Date);
            Morning_time = itemView.findViewById(R.id.morning_time);
            Morning_status = itemView.findViewById(R.id.morning_status);
            Evening_time = itemView.findViewById(R.id.evening_time);
            Evening_status = itemView.findViewById(R.id.evening_status);
        }
    }
}
