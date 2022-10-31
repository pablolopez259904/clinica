import React, { useEffect, useState } from "react";
import {
  ScrollView,
  Button,
  View,
  Text,
  Alert,
  ActivityIndicator,
  StyleSheet,
  Image
} from "react-native";
import { TextInput } from "react-native-gesture-handler";

import firebase from "../database/firebase";

const verMedicamento = (props) => {
  const initialState = {
    id: "",
    nombre: "",
    precio: "",
    marca:"",
    descripcion: "",
  };

  const [user, setUser] = useState(initialState);
  const [loading, setLoading] = useState(true);

  const handleTextChange = (value, prop) => {
    setUser({ ...user, [prop]: value });
  };

  const getUserById = async (id) => {
    const dbRef = firebase.db.collection("users").doc(id);
    const doc = await dbRef.get();
    const user = doc.data();
    setUser({ ...user, id: doc.id });
    setLoading(false);
  };

  const deleteUser = async () => {
    setLoading(true)
    const dbRef = firebase.db
      .collection("users")
      .doc(props.route.params.userId);
    await dbRef.delete();
    setLoading(false)
    props.navigation.navigate("ListarMedicamento");
  };

  const openConfirmationAlert = () => {
    Alert.alert(
      "Quieres Eliminar Medicamento",
      "Estas Seguro ?",
      [
        { text: "Si", onPress: () => deleteUser() },
        { text: "No", onPress: () => console.log("Cancelado") },
      ],
      {
        cancelable: true,
      }
    );
  };

  const updateUser = async () => {
    const userRef = firebase.db.collection("users").doc(user.id);
    await userRef.set({
      nombre: user.nombre,
      precio: user.precio,
      marca: user.marca,
      descripcion: user.descripcion,
    });
    setUser(initialState);
    props.navigation.navigate("ListarMedicamento");
  };

  useEffect(() => {
    getUserById(props.route.params.userId);
  }, []);

  if (loading) {
    return (
      <View style={styles.loader}>
        <ActivityIndicator size="large" color="#9E9E9E" />
      </View>
    );
  }

  return (
    <ScrollView style={styles.container}>
       <Image
          source={{ uri: 'https://png.pngtree.com/png-vector/20190803/ourlarge/pngtree-medicine-pill-capsule-drugs-tablet-flat-color-icon-vector-png-image_1647346.jpg' }}
          style={styles.image}
        />
         <Text style={styles.title}>Detalles del Medicamento:
         
         </Text>
         <Text style={styles.title}>
           
         </Text>
      <View>
        <Text>Nombre Medicamento:  </Text>
        <TextInput
          placeholder="nombre"
          style={styles.inputGroup}
          value={user.nombre}
          onChangeText={(value) => handleTextChange(value, "nombre")}
        />
      </View>
      <View>
      <Text>Precio  Medicamento:  </Text>
        <TextInput
          placeholder="precio"
          style={styles.inputGroup}
          value={user.precio}
          onChangeText={(value) => handleTextChange(value, "precio")}
        />
      </View>
      <View>
      <Text>Marca Medicamento:  </Text>
        <TextInput
         
          placeholder="marca"
          style={styles.inputGroup}
          value={user.marca}
          onChangeText={(value) => handleTextChange(value, "marca")}
        />
      </View>
      <View>
      <Text>Descripcion Medicamento:  </Text>
        <TextInput
          placeholder="descripcion"
         
          style={styles.inputGroup}
          value={user.descripcion}
          onChangeText={(value) => handleTextChange(value, "descripcion")}
        />
      </View>
     
     
  
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 35,
  },
  loader: {
    left: 0,
    right: 0,
    top: 0,
    bottom: 0,
    position: "absolute",
    alignItems: "center",
    justifyContent: "center",
  },
  inputGroup: {
    flex: 1,
    padding: 0,
    marginBottom: 15,
    borderBottomWidth: 1,
    borderBottomColor: "#cccccc",
    justifyContent: "center",
    alignItems: "center"
  },
  btn: {
    marginBottom: 7,
  },
  title: { fontSize: 20},
  image: { height: 200, width: 400 },
});

export default verMedicamento;