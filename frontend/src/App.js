import {BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import Create from './pages/Add/Create';
import "./App.css";
import Products from "./pages/Products/Products";

export default function App() {
	return (
		<Router>
			<Routes>
				<Route exact path="/" element={ <Products /> } />
				<Route exact path="/add" element={ <Create /> } />
			</Routes>
		</Router>
	)
}