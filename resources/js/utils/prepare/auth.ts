import {ModelType} from "../../pages/SignUp/interfaces/Model";
import {SignUpRequest} from "../../interfaces/auth/signup";

export const prepareSignUp = (model: ModelType): SignUpRequest => {
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
