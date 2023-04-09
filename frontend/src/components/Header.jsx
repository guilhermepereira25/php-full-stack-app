import React from "react";
import {Link} from "react-router-dom";
import DeleteButton from "./Button";

export default function Header() {
    return (
        <nav className="navbar navbar-expand-lg navbar-light bg-light">
            <div className="container-fluid">
                <span className="navbar-brand">Product List</span>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul className="navbar-nav">
                        <li className="nav-item">
                            <button className="btn btn-outline-primary"><Link to={"/add"}>Create</Link> </button>
                        </li>
                        <li className="nav-item">
                           <DeleteButton />
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    )
}