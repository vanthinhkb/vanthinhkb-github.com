// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyAhRJUIJsK8c27GcStCWosfUj0-zIj5wHM",
    authDomain: "hichemvn-1e1de.firebaseapp.com",
    projectId: "hichemvn-1e1de",
    storageBucket: "hichemvn-1e1de.appspot.com",
    messagingSenderId: "610680660568",
    appId: "1:610680660568:web:da0740cfcc61568a52202d",
    measurementId: "G-5RYE7N1T8R"
});


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("[firebase-messaging-sw.js] Rec", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});
