package com.example.myapplication.utils;

import com.example.myapplication.model.GioHang;
import com.example.myapplication.model.User;

import java.util.ArrayList;
import java.util.List;

public class Utils {
    public static final String BASE_URL = "https://192.168.1.15/banhang/";
    public static List<GioHang> manggiohang;
    public static List<GioHang> mangmuahang = new ArrayList<>();
    public static User user_current = new User();
}