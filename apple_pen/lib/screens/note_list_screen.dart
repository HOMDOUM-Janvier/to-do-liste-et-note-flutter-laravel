import 'package:flutter/material.dart';
import '../models/note.dart';
import '../services/api_service.dart';
import 'note_detail_screen.dart';
import 'add_note_screen.dart';
import 'edit_note_screen.dart';

class NoteListScreen extends StatefulWidget {
  @override
  _NoteListScreenState createState() => _NoteListScreenState();
}

class _NoteListScreenState extends State<NoteListScreen> {
  late Future<List<Note>> futureNotes;

  @override
  void initState() {

    super.initState();
    futureNotes = ApiService.getNotes();
  }

  void _refreshNotes() {
    setState(() {
      futureNotes = ApiService.getNotes();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Liste des notes'),
        actions: [
          IconButton(
            icon: Icon(Icons.refresh),
            onPressed: _refreshNotes,
          ),
        ],
      ),
      body: FutureBuilder<List<Note>>(
        future: futureNotes,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Erreur: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return Center(child: Text('Aucune note trouvée'));
          } else {
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) {
                Note note = snapshot.data![index];
                return Card(
                  margin: EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  child: ListTile(
                    title: Text(note.title),
                    subtitle: Text(note.content),
                    onTap: () async {
                      final result = await Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) => EditNoteScreen(note: note),
                        ),
                      );
                      if (result == true) {
                        _refreshNotes(); // Rafraîchir la liste après modification ou suppression
                      }
                    },
                  ),
                );
              },
            );
          }
        },
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          Navigator.push(
            context,
            MaterialPageRoute(builder: (context) => AddNoteScreen()),
          ).then((_) => _refreshNotes());
        },
        child: Icon(Icons.add),
      ),
    );
  }
}