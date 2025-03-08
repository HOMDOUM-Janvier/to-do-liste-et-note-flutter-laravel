import 'package:flutter/material.dart';
import '../services/api_service.dart';

class LoginScreen extends StatelessWidget {
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Connexion'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            TextField(
              controller: emailController,
              decoration: InputDecoration(labelText: 'Email'),
            ),
            TextField(
              controller: passwordController,
              obscureText: true,
              decoration: InputDecoration(labelText: 'Mot de passe'),
            ),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: () async {
                try {
                  String token = await ApiService.login(
                    emailController.text,
                    passwordController.text,
                  );
                  await ApiService.saveToken(token); // Stocke le token
                  Navigator.pushReplacementNamed(context, '/'); // Redirige vers HomeScreen
                } catch (e) {
                  ScaffoldMessenger.of(context).showSnackBar(
                    SnackBar(content: Text('Erreur: $e')),
                  );
                }
              },
              child: Text('Se connecter'),
            ),
            SizedBox(height: 20),
            TextButton(
              onPressed: () {
                // Rediriger vers l'écran d'inscription (à implémenter)
              },
              child: Text('Pas de compte ? S\'inscrire'),
            ),
          ],
        ),
      ),
    );
  }
}