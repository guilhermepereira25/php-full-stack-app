import React, {useState} from "react";
import Header from "../../components/Header";

const handleSubmit = (e) => {
    e.preventDefault()
    const action = e.target.action
    const price = e.target.value

    fetch(action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ price })
    })
        .then(response => response.json())
        .then(data => console.log(data.response))
        .catch(error => console.error(error))
}

function MyForm(props) {
    const price = useState("")

    return (
        <form action={props.action} method="POST" onSubmit={(event) => handleSubmit(event)}>
            <div className="mb-3">
                <label htmlFor="price" className="form-label">{props.labelOne}</label>
                <input type="number" name="name" className="form-control" id="price" value={price}/>
                <div className="form-text">Ok, beleza?</div>
            </div>
        </form>
    )
}

export default function Create() {
    return (
        <div className="container">
            <Header />

            <MyForm action="http://localhost:80/api/products/create" labelOne="Seu nome aqui" />
        </div>
    )
}