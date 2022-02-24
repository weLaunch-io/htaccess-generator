<?
namespace models;

interface modelInterface
{
    public function insert($data);
    public function update($data, $id);
    public function delete($id);
    public function getAll();
}