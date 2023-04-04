import React from 'react';
import { useState } from "react";

export default function Index() {
	const [name, setName] = useState("");
	const [result, setResult] = useState("");

	const handleChange = (e) => {
		setName(e.target.value);
	};

	const handleSumbit = (e) => {
		e.preventDefault();
		const action = e.target.action

		fetch(action, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({ name })
		})
		.then(response => response.json())
		.then(data => setResult(data.response))
		.catch(error => console.error(error))
	};

	return (
		<div className="App">
			<form
				action="http://localhost:80/products"
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
