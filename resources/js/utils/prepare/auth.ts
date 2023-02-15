import {ModelRequest, ModelType} from "../../pages/SignUp/interfaces/Model";

export const prepareSignUp = (model: ModelType): ModelRequest => {
    const {firstName, lastName, password, reenteredPassword, email, integrator} = model
    return {
        first_name: firstName,
        last_name: lastName,
        password,
        password_confirmation: reenteredPassword,
        email,
        integrator_id: integrator
    }
}
