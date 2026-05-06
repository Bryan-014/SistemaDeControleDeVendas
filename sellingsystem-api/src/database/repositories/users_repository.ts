import { User } from "../../../models/user.ts";
import { CreateUserDTO } from "../../dto/create_user_dto.ts";
import { IUsersRepository } from "../../interfaces/repositories/i_users_repository.ts";

export class UsersRepository implements IUsersRepository {

  async create(data: CreateUserDTO): Promise<User> {
    return await User.create(data);
  }

  async findByUsername(username: string): Promise<User | null> {
    return await User.findOne({ where: { username } });
  }

  async findById(id: string): Promise<User | null> {
    return await User.findByPk(id);
  }
}