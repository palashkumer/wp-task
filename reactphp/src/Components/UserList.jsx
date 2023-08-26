import axios from "axios";
import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";

function UserList() {
    const [userData, setUserData] = useState([]);
    const [message, setMessage] = useState("");

    useEffect(() => {
        getUserData();
    }, []);

    const getUserData = async () => {
        try {
            const reqData = await fetch("http://localhost/wp-task/api/index.php");
            const resData = await reqData.json();
            setUserData(resData);
        } catch (error) {
            console.error("Error fetching user data:", error);
        }
    };

    const handleDelete = async (id) => {
        try {
            const res = await axios.delete(`http://localhost/wp-task/api/index.php/${id}`);
            setMessage(res.data.success);
            getUserData();
        } catch (error) {
            console.error("Error deleting user:", error);
            setMessage("Failed to delete user.");
        }
    };

    return (
        <React.Fragment>
            <div className="container">
                <div className="row">
                    <div className="col-md-10 mt-4">
                        <h5 className="mb-4">User List</h5>
                        <p className="text-danger">{message}</p>
                        <div>
                            {userData.length === 0 ? (
                                <p>No data to display</p>
                            ) : (
                                <table className="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.No</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {userData.map((uData, index) => (
                                            <tr key={index}>
                                                <td>{uData.id}</td>
                                                <td>{uData.username}</td>
                                                <td>{uData.email}</td>
                                                <td>{uData.status === 1 ? "Active" : "Inactive"}</td>
                                                <td>
                                                    <Link to={`/edituser/${uData.id}`} className="btn btn-success mx-2">
                                                        Edit
                                                    </Link>
                                                    <button className="btn btn-danger" onClick={() => handleDelete(uData.id)}>
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </React.Fragment>
    );
}

export default UserList;
