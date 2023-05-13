import React from 'react';
import { useState, useEffect } from "react";
import Header from "../../components/Header";
import Footer from "../../components/Footer";
import Card from "../../components/Card/Card";
import {apiUrl} from "../../constraints";

function Products() {
	console.log(process.env)
	const [products, setProducts] = useState([]);
	const [selectIds, setSelectIds] = useState([])

	useEffect(() => {
		fetch(apiUrl.url.API_URL + '/api/products', {
				method: "GET"
			}
		)
		.then(response => response.json())
		.then(data => {
			setProducts(data)
		});
	}, []);

	const handleSelectedIds = (id) => {
		if (selectIds.includes(id)) {
			setSelectIds(selectIds.filter(item => item !== id))
		} else {
			setSelectIds([...selectIds, id])
		}
	}

	const handleDeleteSelected = () => {

		fetch(apiUrl.url.API_URL + '/delete', {
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
