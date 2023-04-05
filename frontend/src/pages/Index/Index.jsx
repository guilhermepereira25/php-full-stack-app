import React from 'react';
import { useState } from "react";
import Header from "../../components/Header";
import { Link } from "react-router-dom";

function MyButton(props) {
	return (
		<Link to={props.to} className="btn btn-primary">{props.text}</Link>
	)
}

export default function Index() {
	const [name, setName] = useState("");
	const [result, setResult] = useState("");

	const handleChange = (e) => {
		setName(e.target.value);
	};

	const handleSubmit = (e) => {
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
		<>
			<Header />

			<form
				action="http://localhost:80/api/products"
				method="post"
				onSubmit={(event) => handleSubmit(event)}
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

			<MyButton to="/add" text="Add new product" />
		</>
	);
}
