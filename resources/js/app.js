import './bootstrap';
import React, {Component} from 'react'
import Header from './components/Header'
import Footer from './components/Footer'
import {render} from 'react-dom'

class MiApp extends Component {
 render() {
  return (
   <Header/>
    <h1> La mejor App del mundo </h1> 
   <Footer year="2017"/>
  )
 }
}

render(<MiApp/>); document.querySelector('#app');