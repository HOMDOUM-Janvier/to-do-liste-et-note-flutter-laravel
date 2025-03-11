import 'package:flutter/material.dart';

class NoteItem extends StatelessWidget {
  final Map<String, dynamic> note;
  final VoidCallback onDelete;

  NoteItem({required this.note, required this.onDelete});

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: EdgeInsets.symmetric(vertical: 8, horizontal: 16),
      child: ListTile(
        title: Text(note['title']),
        subtitle: Text(note['description'] ?? 'Pas de description'),
        trailing: IconButton(
          icon: Icon(Icons.delete, color: Colors.red),
          onPressed: onDelete,
        ),
      ),
    );
  }
}