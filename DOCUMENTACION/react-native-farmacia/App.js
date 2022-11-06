import {StatusBar} from 'expo-status-bar';
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import {NavigationContainer}  from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';

const Stack = createStackNavigator()
import ListarMedicamento from './screens/ListarMedicamento';
import CrearMedicamento from './screens/CrearMedicamento';
import verMedicamento from './screens/verMedicamento';

function MyStack(){
  return(
    
      <Stack.Navigator>
          <Stack.Screen name= "ListarMedicamento" component={ListarMedicamento}/>
          <Stack.Screen name= "CrearMedicamento" component={CrearMedicamento}/>   
          <Stack.Screen name= "verMedicamento" component={verMedicamento}/>
      </Stack.Navigator>
  )
}

export default function App() {
  return (
   <NavigationContainer>
      <MyStack/>
   </NavigationContainer>

  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
