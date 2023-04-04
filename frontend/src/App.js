import {BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import Index from './pages/Index/Index';
import Update from './pages/Update/Update';
import Create from './pages/Add/Create';
import "./App.css";

export default function App() {
	return (
		<Router>
			<Routes>
				<Route exact path="/" element={ <Index /> } />
				<Route exact path="/update" element={ <Update /> } />
				<Route exact path="/add" element={ <Create /> } />
			</Routes>
		</Router>
	)
}