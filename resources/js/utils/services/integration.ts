import {baseService} from "./axios";
import {Api} from "../../interfaces/api";
import {IntegratorResponse} from "../../interfaces/integrator/integrator";

export const getIntegrations = () => {
    return baseService.get<Api<IntegratorResponse[]>>('/integration/');
}
