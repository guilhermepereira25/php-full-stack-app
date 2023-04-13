import React, {useState} from "react";
import Header from "../../components/Header";
import Footer from "../../components/Footer";

function CdComponent() {
    return (
        <>
            <h1>Hello, world reaaact</h1>
        </>
    )
}

function Input({id, name, value, onchange, labelText, type}) {
    return (
        <>
            <label htmlFor={name} className="form-label">{labelText}</label>
            <input type={type} name={name} className="form-control" id={id} value={value} onChange={((e) => onchange(e))} />
        </>
    )
}

function MyForm(props) {
    const [formData, setFormData] = useState({
        sku: "",
        name: "",
        price: "",
        type: "",
        value: ""
    })

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        })
    }

    const handleSubmit = (e) => {
        e.preventDefault()
        const action = e.target.action

        fetch(action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ formData })
        })
            .then(response => response.json())
            .then(data => console.log(data.response))
            .catch(error => console.error(error))
    }

    const renderComponent = () => {
        const type = formData.type

        switch (type) {
            case 'cd':
                return <CdComponent />;
            case 'book':
                return;
            case 'furniture':
                break;
            default:
                break;
        }
    }

    return (
            <div className={"container"}>
                <form action={props.action} method="POST" onSubmit={(event) => handleSubmit(event)}>
                    <div className="mb-3">
                        <Input name={"sku"} id={"sku"} type={"text"} value={formData.sku} onchange={handleChange} labelText={"SKU (unique)"} />

                        <Input name={"name"} id={"name"} type={"text"} value={formData.name} onchange={handleChange} labelText={"Your project name"} />

                        <Input name={"price"} id={"price"} type={"number"} value={formData.price} onchange={handleChange} labelText={"Price"} />

                        <label htmlFor={"productType"} className={"form-label"}>Tu é meio burro hein paizao</label>
                            <select name={"type"} id={"productType"} className={"form-select"} onChange={(e) => handleChange(e)}>
                                <option selected>Selecione o tipo</option>
                                <option value={'cd'}>Cd</option>
                                <option value={'book'}>Book</option>
                                <option value={'furniture'}>Furniture</option>
                            </select>

                        {renderComponent()}

                        <button type={"submit"} className={"btn btn-primary mt-3"}>Submit</button>
                    </div>
                </form>
            </div>
    )
}

export default function Create() {
    return (
        <div className="container">
            <Header />

            <MyForm action="http://localhost:80/api/products/create" />

            <Footer />
        </div>
    )
}