import React, {useState} from 'react'
import {View, Button, TextInput, ScrollView, StyleSheet} from 'react-native';
import firebase from '../database/firebase.js'


const CrearMedicamento = (props) => {
    
    const [state, setState] = useState({
        nombre: "",
        precio: "",
        marca: "",
        descripcion: ""
    });

    const handleChangeText = (nombre,value) => {
        setState({ ...state, [nombre]: value});
    };
    
    const SaveNewUser = async () => {
    
        if(state.nombre===''){
            alert('Porfavor Ingrese nombre')
        }
        else{
            
            try {
                await firebase.db.collection('users').add({
              
                    nombre:  state.nombre,
                    precio: state.precio,
                    marca: state.marca,
                    descripcion: state.descripcion
                })
                props.navigation.navigate('ListarMedicamento');
            } catch (error) {
                console.log(error);
            }
        }
    }
    return (
        <ScrollView style={styles.container}>
            <View style={styles.inputGroup}>
                <TextInput placeholder="Nombre Medicamento" 
                onChangeText={(value) => handleChangeText('nombre',value)}  />
            </View>
            <View style={styles.inputGroup}>
                <TextInput placeholder="Precio Medicamento"
                onChangeText={(value) => handleChangeText('precio',value)}/>
            </View>
            <View style={styles.inputGroup}>
                <TextInput placeholder="Marca Medicamento"
                onChangeText={(value) => handleChangeText('marca',value)}/>
            </View>
            <View style={styles.inputGroup}>
                <TextInput placeholder="Descripcion Medicamento"
                onChangeText={(value) => handleChangeText('descripcion',value)}/>
            </View>
            <View style={styles.inputGroup}>
                <Button title="Guardar Medicamento" onPress={() =>  SaveNewUser()}/>
            </View>
        </ScrollView>
       
    )
}

const  styles = StyleSheet.create({
    container:{
        flex:1,
        padding:35
    },
    inputGroup: {
        flex: 1,
        padding:0,
        marginBottom:15,
        borderBottomWidth:1,
        borderBottomColor: '#cccccc'
    }
})
export default CrearMedicamento
