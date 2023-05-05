import React from "react";
import {Link} from "react-router-dom";

export default function Header(props) {
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
                        <li className="nav-item me-1">
                            <Link to={"/add"}><button className="btn btn-outline-secondary" style={{width: 100}}>Create</button></Link>
                        </li>
                        <li className="nav-item">
                            <button className="btn btn-outline-danger" onClick={() => props.handleDeleteSelected()}>Mass Delete</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    )
}