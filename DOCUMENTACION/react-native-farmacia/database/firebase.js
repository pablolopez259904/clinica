import firebase from 'firebase';
import 'firebase/firestore';

var firebaseConfig = {
    apiKey: "AIzaSyBKalEvUcJmpS4a2DpQRL2tE0bdvgh3N7M",
    authDomain: "react-native-farmacia.firebaseapp.com",
    projectId: "react-native-farmacia",
    storageBucket: "react-native-farmacia.appspot.com",
    messagingSenderId: "365882028916",
    appId: "1:365882028916:web:3757b0f31646e672a2f221"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const db = firebase.firestore();

export default {
  firebase,
  db
};