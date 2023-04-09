import {BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import Update from './pages/Update/Update';
import Create from './pages/Add/Create';
import "./App.css";
import Products from "./pages/Products/Products";

export default function App() {
	return (
		<Router>
			<Routes>
				<Route exact path="/" element={ <Products /> } />
				<Route exact path="/update" element={ <Update /> } />
				<Route exact path="/add" element={ <Create /> } />
			</Routes>
		</Router>
	)
}