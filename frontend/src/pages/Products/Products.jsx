import React from 'react';
import { useState, useEffect } from "react";
import Header from "../../components/Header";
import Footer from "../../components/Footer";
import Card from "../../components/Card/Card";

function Products() {
	const [products, setProducts] = useState([]);
	const [selectIds, setSelectIds] = useState([])

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

	const handleSelectedIds = (id) => {
		console.log(selectIds)
		if (selectIds.includes(id)) {
			setSelectIds(selectIds.filter(item => item !== id))
		} else {
			setSelectIds([...selectIds, id])
		}
	}

	const handleDeleteSelected = () => {
		console.log(selectIds)

		fetch('http://localhost:80/api/products/delete', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					ids: selectIds
				})
			}
		)
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				setTimeout(() => {
					window.location.reload()
				}, 3000)
			}
		})
	}

	return (
		<>
			<Header handleDeleteSelected={handleDeleteSelected} />

			<Card data={products} handleSelectedIds={handleSelectedIds} />

			<Footer />
		</>
	);
}

export default Products;
