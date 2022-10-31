import React, { useState, useEffect } from "react";
import { Button, StyleSheet, Text, Image, View } from "react-native";
import { ListItem, Avatar } from "react-native-elements";
import { ScrollView } from "react-native-gesture-handler";

import firebase from "../database/firebase";

const ListarMedicamento = (props) => {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    firebase.db.collection("users").onSnapshot((querySnapshot) => {
      const users = [];
      querySnapshot.docs.forEach((doc) => {
        const { nombre, precio, marca, descripcion } = doc.data();
        users.push({
          id: doc.id,
          nombre,
          precio,
          marca,
          descripcion,
        });
      });
      setUsers(users);
    });
  }, []);


  return (

    <ScrollView>
      <View style={styles.container}>
        <Text style={styles.title}>Grupo No. 4</Text>
        <Image
          source={{ uri: ' https://comotramitar.org/wp-content/uploads/2021/05/Mi-UMG-Universidad-Mariano-Galvez-de-Guatemala.jpg' }}
          style={styles.image}
        />
         
      <Text style={styles.title}>Medicamentos en inventario</Text>
      </View>
      
     
      {users.map((user) => {
        return (
          <ListItem
            key={user.id}
            bottomDivider
            onPress={() => {
              props.navigation.navigate("verMedicamento", {
                userId: user.id,
              });
            }}
          >
            <ListItem.Chevron />
            <Avatar
              source={{
                uri:
                  "https://png.pngtree.com/png-vector/20190803/ourlarge/pngtree-medicine-pill-capsule-drugs-tablet-flat-color-icon-vector-png-image_1647346.jpg",
              }}
              rounded
            />
            <ListItem.Content>
              <ListItem.Title>{user.nombre}</ListItem.Title>
              <ListItem.Subtitle>   Marca: {user.marca}</ListItem.Subtitle>
              <ListItem.Subtitle>       Precio: {user.precio}</ListItem.Subtitle>
            </ListItem.Content>
          </ListItem>
        );
      })}
    </ScrollView>
  );
};


const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: "center", alignItems: "center" },
  title: { fontSize: 20},
  image: { height: 200, width: 400 }
});
export default ListarMedicamento;
