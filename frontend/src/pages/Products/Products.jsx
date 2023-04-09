import React from 'react';
import { useState, useEffect } from "react";
import Header from "../../components/Header";
import Footer from "../../components/Footer";
import Card from "../../components/Card/Card";

function Products() {
	const [products, setProducts] = useState([]);

	useEffect(() => {
		fetch('http://localhost:80/api/products', {
				method: "GET"
			}
		)
			.then(response => response.json())
			.then(data => {
				setProducts(data)
			});
	}, []);

	return (
		<>
			<Header />

			<Card data={products} />

			<Footer />
		</>
	);
}

export default Products;
