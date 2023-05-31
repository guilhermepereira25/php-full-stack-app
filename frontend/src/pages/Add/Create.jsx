import React, {useState} from "react";
import Header from "../../components/Header";
import Footer from "../../components/Footer";
import {useNavigate} from "react-router-dom";
import {apiUrl} from "../../constraints";

function FurnitureComponent({func}) {
    const [inputValue, setInputValue] = useState({
        height: "",
        width: "",
        length: ""
    })

    const handleChange = (e) => {
        setInputValue({
            ...inputValue,
            [e.target.name]: e.target.value
        })

        if (inputValue.width !== "" && inputValue.length !== "" && inputValue.height !== "") {
            let calc = inputValue.height * inputValue.width * inputValue.length

            func(calc)
        }
    }

    return (
        <>
            <label className={"form-label"} htmlFor={"height"}>Height</label>
            <input type={"number"} id={"height"} name={"height"} value={inputValue.height} className={"form-control"} onChange={(e) => handleChange(e)} />

            <label className={"form-label"} htmlFor={"width"}>Width</label>
            <input type={"number"} id={"width"} name={"width"} value={inputValue.width} className={"form-control"} onChange={(e) => handleChange(e)} />

            <label className={"form-label"} htmlFor={"length"}>Length</label>
            <input type={"number"} id={"length"} name={"length"} value={inputValue.length} className={"form-control"} onChange={(e) => handleChange(e)} />
        </>
    )
}

function Input({id, name, value, onchange, labelText, type}) {
    return (
        <>
            <label htmlFor={name} className="form-label">{labelText}</label>
            <input type={type} required={true} name={name} className="form-control" id={id} value={value} onChange={((e) => onchange(e))} />
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

    const navigate = useNavigate()

    const handleSubmit = async (event) => {
        event.preventDefault()

        try {
            const url = fetch(apiUrl.url.API_URL + '/api/products/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    sku: formData.sku,
                    name: formData.name,
                    price: formData.price,
                    type: formData.type,
                    value: parseFloat(formData.value)
                })
            })

            url.then((response) => {
                if (response.status !== 201) {
                    throw new Error(`Http error: ${response.status}`)
                }
                
                return response.json()
            }).then((data) => {
                if (data.success) {
                    navigate('/')
                }
            })
        } catch (err) {
            console.error(err.message)
        }
    }

    const calcFurniture = (result) => {
        setFormData({
                ...formData,
                value: result
            }
        )
    }

    const renderComponent = () => {
        const type = formData.type

        switch (type) {
            case 'DVD':
                return <Input id={"size"} name={"value"} value={formData.value} type={"text"} labelText={"Describe your cd product"} onchange={handleChange} />
            case 'book':
                return <Input id={"weight"} name={"value"} value={formData.value} type={"number"} labelText={"Describe your book in kg"} onchange={handleChange} />
            case 'furniture':
                return <FurnitureComponent func={calcFurniture}  />
            default:
                break;
        }
    }

    return (
            <div className={"container"}>
                <form action={props.action} id={"product_form"} method="POST" onSubmit={(event) => handleSubmit(event)}>
                    <div className="mb-3">
                        <Input name={"sku"} id={"sku"} type={"text"} value={formData.sku} onchange={handleChange} labelText={"SKU (unique)"} />

                        <Input name={"name"} id={"name"} type={"text"} value={formData.name} onchange={handleChange} labelText={"Your project name"} />

                        <Input name={"price"} id={"price"} type={"number"} value={formData.price} onchange={handleChange} labelText={"Price"} />

                        <label htmlFor={"productType"} className={"form-label"}>Type</label>
                            <select name={"type"} id={"productType"} className={"form-select"} onChange={(e) => handleChange(e)}>
                                <option defaultValue={"null"}>Choose the type</option>
                                <option id={"dvd"} value={'DVD'}>DVD</option>
                                <option id={"book"} value={'book'}>Book</option>
                                <option id={"furniture"} value={'furniture'}>Furniture</option>
                            </select>

                        {renderComponent()}

                        <button type={"submit"} className={"btn btn-primary mt-3"}>Save</button>
                    </div>
                </form>
            </div>
    )
}

export default function Create() {
    return (
        <div className="container">
            <Header />

            <MyForm />

            <Footer />
        </div>
    )
}