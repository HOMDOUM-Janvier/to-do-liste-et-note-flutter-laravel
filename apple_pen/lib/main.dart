import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart'; // Importation ajoutée
import 'screens/home_screen.dart';
import 'screens/login_screen.dart';
import 'screens/register_screen.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized(); // Assure que Flutter est initialisé
  final prefs = await SharedPreferences.getInstance(); // Récupère l'instance de SharedPreferences
  final token = prefs.getString('auth_token'); // Récupère le token stocké
  runApp(MyApp(initialRoute: token != null ? '/' : '/login')); // Démarre l'application
}

class MyApp extends StatelessWidget {
  final String initialRoute;

  MyApp({required this.initialRoute});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'To-Do List & Notes',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      initialRoute: initialRoute,
      routes: {
        '/': (context) => HomeScreen(),
        '/login': (context) => LoginScreen(),
        '/register': (context) => RegisterScreen(),
      },
    );
  }
}