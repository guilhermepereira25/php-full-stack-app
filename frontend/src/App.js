import { useState } from "react";
import "./App.css";

function App() {
	const [name, setName] = useState("");
	const [result, setResult] = useState("");

	const handleChange = (e) => {
		setName(e.target.value);
	};

	const handleSumbit = (e) => {
		e.preventDefault();
		const form = e.target.action

		fetch(form, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({ name })
		})
		.then(response => response.json)
		.then(data => console.log(data))
		.catch(error => console.error(error))
	};

	return (
		<div className="App">
			<form
				action="http://localhost:80/"
				method="post"
				onSubmit={(event) => handleSumbit(event)}
			>
				<label htmlFor="name">Name: </label>
				<input
					type="text"
					id="name"
					name="name"
					value={name}
					onChange={(event) => handleChange(event)}
				/>
				<br />
				<button type="submit">Submit</button>
			</form>
			<h1>{result}</h1>
		</div>
	);
}

export default App;